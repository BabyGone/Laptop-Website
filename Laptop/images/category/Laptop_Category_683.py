graph = {
        '1': ['2', '3', '4'],
        '2': ['5', '6'],
        '3': ['7'],
        '5': ['7'],
        }
def dfs(graph_to_seach, start, end):
    # tạo một ngăn xếp của đường đi
    stack = []
    visit =[]
    # đưa điểm đâu tiên vào trong ngăn xếp
    stack.append(start)
    visit.append(start)
    print('Thu tu duyet:')
    while stack:
        # lấy đường đi dầu tiên trong ngăn xếp
        path = stack.pop(0)
        # lấy vị trí cuối cùng trong đường đi
        node = path[-1]
        print(node,end=' ')
        # xuất đương đi đã tìm thấy
        if node == end:
            print("\nDuong di la: ")
            return path
        # liệt kê các nút liền kề và tạo một đưỜng đi mới và thêm vào ngăn xếp
        stack_check = []
        for adjacent in reversed(graph_to_seach.get(node,[])):
            if(adjacent not in visit):
                visit.append(adjacent)
                new_path = list(path)
                new_path.append(adjacent)
                stack.insert(0,new_path)
print(dfs(graph, '1', '7'))
