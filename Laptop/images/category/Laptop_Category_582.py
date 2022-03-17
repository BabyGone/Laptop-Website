# graph là biểu diễn danh sách liền kề bằng dir
graph = {
        '1': ['2', '3', '4'],
        '2': ['5', '6'],
        '3': ['7'],
        '5': ['7'],
        }
def dls(graph_to_seach, start, end, n):
    # tạo một ngăn xếp của đường đi
    stack = []
    visit =[]
    depth = []
    # đưa điểm đâu tiên vào trong ngăn xếp
    stack.append([[start],0])
    print("\nThu tu duyet: ")
    while stack:
        # lấy đường đi dầu tiên trong ngăn xếp
        path = stack.pop(0)
        #print(path)
        # lấy vị trí cuối cùng trong đường đi
        node = path[0][-1]
        print(node,end=' ') 
        # xuất đương đi đã tìm thấy
        if node == end:
            print('\nDuong di la:',end=' ')
            return path[0]
        # liệt kê các nút liền kề và tạo một đưỜng đi mới và thêm vào ngăn xếp
        if(path[1]<n):
            for adjacent in reversed(graph_to_seach.get(node,[])):
                    new_path = list(path[0])
                    new_path.append(adjacent)
                    path_check=[]
                    depth_check = path[1]+1
                    path_check.append(new_path)
                    path_check.append(depth_check)
                    stack.insert(0,path_check)
def dds(graph_to_seach, start, end, max):
    for i in range(0,max+1):
        a=dls(graph_to_seach,start,end,i)
        if a:
            return a
print(dds(graph,'1','7',3))
